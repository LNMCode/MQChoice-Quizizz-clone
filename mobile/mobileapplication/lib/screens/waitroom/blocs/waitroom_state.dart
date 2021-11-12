import 'package:equatable/equatable.dart';
import 'package:mobileapplication/models/getroom/room_response.dart';
import 'package:flutter/cupertino.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';

class WaitRoomState extends Equatable {
  const WaitRoomState();

  @override
  List<Object?> get props => [];
}

class WaitRoomStateInitial extends WaitRoomState {}

class WaitRoomStateFail extends WaitRoomState {}

class WaitRoomSuccess extends WaitRoomState {
  final StreamSocket streamSocket;
  const WaitRoomSuccess(this.streamSocket);
}
