import 'package:equatable/equatable.dart';
import 'package:mobileapplication/models/getroom/room_response.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';

class WaitRoomFinishState extends Equatable {
  const WaitRoomFinishState();

  @override
  List<Object?> get props => [];
}

class WaitRoomFinishStateLoading extends WaitRoomFinishState {}

class WaitRoomFinishStateFail extends WaitRoomFinishState {}

class WaitRoomFinishStateSuccess extends WaitRoomFinishState {
  final StreamSocket socket;
  final RoomResponse roomResponse;
  const WaitRoomFinishStateSuccess(this.socket, this.roomResponse);
}
