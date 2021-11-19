import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/models/getroom/room_response.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:mobileapplication/screens/summary/summary_screen.dart';
import 'package:mobileapplication/screens/waitroom_finish/blocs/waitroom_finish_bloc.dart';
import 'package:mobileapplication/screens/waitroom_finish/blocs/waitroom_finish_event.dart';
import 'package:mobileapplication/screens/waitroom_finish/blocs/waitroom_finish_state.dart';
import 'package:mobileapplication/screens/waitroom_finish/components/waitroom_finish_body.dart';

class WaitRoomFinishScreen extends StatefulWidget {
  final String idroom;
  final String iduser;

  const WaitRoomFinishScreen({
    Key? key,
    required this.idroom,
    required this.iduser,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _WaitRoomFinishScreen();
}

class _WaitRoomFinishScreen extends State<WaitRoomFinishScreen> {
  late StreamSocket _streamSocket;
  RoomResponse? _roomResponse;

  @override
  void initState() {
    super.initState();
    // Connect to socket server to wait finish room
    BlocProvider.of<WaitRoomFinishBloc>(context)
        .add(WaitRoomFinishEventConnected(
      idroom: widget.idroom,
      iduser: widget.iduser,
    ));
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: BlocConsumer<WaitRoomFinishBloc, WaitRoomFinishState>(
        listener: (context, state) {
          if (state is WaitRoomFinishStateSuccess) {
            _roomResponse = state.roomResponse;
          }
        },
        builder: (context, state) {
          if (state is WaitRoomFinishStateLoading) {
            return CircularProgressIndicator();
          }
          if (_roomResponse != null && state is WaitRoomFinishStateSuccess) {
            _streamSocket = state.socket;
            return StreamBuilder(
              stream: _streamSocket.getResponse,
              builder: (context, snapshot) {
                if (snapshot.hasData && snapshot.data == widget.idroom) {
                  print('Change thoi du ma m');
                  Future.delayed(Duration.zero, () {
                    Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(builder: (context) {
                        return SummaryScreen(
                          idroom: widget.idroom,
                          iduser: widget.iduser,
                        );
                      }),
                    );
                  });
                }
                if (snapshot.hasError) {
                  return Text('Some thing error ' + snapshot.error.toString());
                }
                return WaitRoomFinishBody(
                  room: _roomResponse!.doc,
                  iduser: widget.iduser,
                );
              },
            );
          }
          return Center(
            child: Column(
              children: [
                Text(widget.idroom),
                Text(widget.iduser),
              ],
            ),
          );
        },
      ),
    );
  }
}
